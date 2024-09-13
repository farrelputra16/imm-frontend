<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\DB;
use MattDaneshvar\Survey\Models\Survey;
use Illuminate\Support\Facades\Auth;
use MattDaneshvar\Survey\Models\Entry;
use App\Models\User;
use App\Models\Project;
use Illuminate\Validation\ValidationException;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();
        return view('surveys.index', compact('surveys'));
    }

    public function create($id)
    {
        $project = Project::with(['tags', 'sdgs', 'metrics', 'targetPelanggan', 'dana'])->findOrFail($id);

        return view('survey.edit-survey.create', compact('project'));
    }

    public function store(Request $request)
    {
        try {
            logger($request->all()); // Use Laravel's logger

            $request->validate([
                'name' => 'required|string|max:255',
                'settings.accept-guest-entries' => 'required',
                'settings.limit-per-participant' => 'required',
                'sections' => 'required|array',
                'sections.*.name' => 'required|string',
                'sections.*.questions' => 'required|array',
                'sections.*.questions.*.content' => 'required|string',
                'sections.*.questions.*.type' => 'required|string',
                'sections.*.questions.*.rules' => 'nullable|string',
            ]);

            $survey = Survey::create([
                'name' => $request->name,
                'settings' => [
                    'accept-guest-entries' => filter_var($request->settings['accept-guest-entries'], FILTER_VALIDATE_BOOLEAN),
                    'limit-per-participant' => (int) $request->settings['limit-per-participant'],
                ]
            ]);

            foreach ($request->sections as $sectionData) {
                $section = $survey->sections()->create(['name' => $sectionData['name']]);

                foreach ($sectionData['questions'] as $questionData) {
                    $section->questions()->create([
                        'content' => $questionData['content'],
                        'type' => $questionData['type'],
                        'rules' => isset($questionData['rules']) ? explode(',', $questionData['rules']) : [],
                        'options' => isset($questionData['options']) ? $questionData['options'] : null,
                    ]);
                }
            }

            DB::update('UPDATE surveys SET project_id = ? WHERE id = ?', [$request->project_id, $survey->id]);

            return redirect()->route('projects.view', $request->project_id)->with('success', 'Survey created successfully');
        } catch (\Exception $e) {
            Log::error('Survey creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create survey. Please try again later.',
            ]);
        }
    }

    public function view($id)
    {
        $survey = Survey::with('sections.questions')->findOrFail($id);
        $lastEntry = Entry::where('participant_id', auth()->id())
            ->where('survey_id', $survey->id)
            ->latest()
            ->first();

        return view('survey.responden.responden', compact('survey', 'lastEntry'));
    }

    public function dataDiri($id)
    {
        $survey = Survey::with('sections.questions')->findOrFail($id);
        $lastEntry = Entry::where('participant_id', auth()->id())
            ->where('survey_id', $survey->id)
            ->latest()
            ->first();

        if ($lastEntry) {
            return view('survey.responden.responden-data-diri', compact('survey', 'lastEntry'));
        }
        return view('survey.responden.responden-data-diri', compact('survey'));
    }

    public function edit(Survey $survey)
    {
        return view('survey.edit-survey.edit-survey-new', compact('survey'));
    }

    public function update(Request $request, Survey $survey)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'settings.accept-guest-entries' => 'required',
                'settings.limit-per-participant' => 'required',
                'sections' => 'required|array',
                'sections.*.name' => 'required|string',
                'sections.*.questions' => 'required|array',
                'sections.*.questions.*.content' => 'required|string',
                'sections.*.questions.*.type' => 'required|string',
                'sections.*.questions.*.rules' => 'nullable|string',
            ]);

            // Update Survey
            $survey->update([
                'name' => $request->name,
                'settings' => [
                    'accept-guest-entries' => filter_var($request->settings['accept-guest-entries'], FILTER_VALIDATE_BOOLEAN),
                    'limit-per-participant' => (int) $request->settings['limit-per-participant'],
                ]
            ]);

            // Loop through each section in the request
            foreach ($request->sections as $sectionData) {
                $section = $survey->sections()->updateOrCreate(
                    ['name' => $sectionData['name']], // Find or create the section by name
                    ['name' => $sectionData['name']] // Update the section's name
                );

                // Loop through each question in the section
                foreach ($sectionData['questions'] as $questionData) {
                    $section->questions()->updateOrCreate(
                        ['content' => $questionData['content']], // Find or create the question by content
                        [
                            'type' => $questionData['type'], // Update the question's type
                            'rules' => isset($questionData['rules']) ? explode(',', $questionData['rules']) : [],
                            'options' => isset($questionData['options']) ? $questionData['options'] : null, // Update the question's options
                        ]
                    );
                }
            }

            return redirect()->route('projects.view', $request->project_id)->with('success', 'Survey updated successfully');
        } catch (\Exception $e) {
            Log::error('Survey update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update survey. Please try again later.');
        }
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->back()->with('success', 'Survey deleted successfully');
    }

    public function createEntry(Survey $survey, User $user, ?Entry $lastEntry = null)
    {
        $alreadySubmitted = $lastEntry !== null;

        if ($alreadySubmitted) {
            return view('survey.responden.responden-penutup-survey', compact('survey', 'alreadySubmitted'));
        }

        return view('survey.responden.kuesioner', compact('survey', 'user', 'lastEntry'));
    }


    public function registerUser(Request $request, $id)
    {
        $survey = Survey::with('sections.questions')->findOrFail($id);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            $data = $request->validate([
                'nama_depan' => 'required|string|max:255',
                'nama_belakang' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telepon' => 'required|string|max:13',
            ]);

            $user = User::create([
                'nama_depan' => $data['nama_depan'],
                'nama_belakang' => $data['nama_belakang'],
                'email' => $data['email'],
                'password' => 'nonlogin',
                'telepon' => $data['telepon'],
                'role' => 'USER',
            ]);

            $lastEntry = null;
        } else {
            $lastEntry = Entry::where('participant_id', $user->id)
                ->where('survey_id', $survey->id)
                ->latest()
                ->first();
        }

        return $this->createEntry($survey, $user, $lastEntry);
    }

    public function submit(Survey $survey, Request $request, User $user)
    {
        try {
            Log::info('Incoming request data:', $request->all());

            // Check if the user has already submitted the survey
            $lastEntry = Entry::where('participant_id', $user->id)
                ->where('survey_id', $survey->id)
                ->latest()
                ->first();
            $alreadySubmitted = $lastEntry !== null;

            // Validate the request data against the survey's rules
            $answers = $request->validate($survey->rules);

            // Create a new entry for the survey with the validated answers
            if (!$alreadySubmitted) {
                (new Entry)->for($survey)->by($user)->fromArray($answers)->push();
            }

            return view('survey.responden.responden-penutup-survey', compact('survey', 'alreadySubmitted'));
        } catch (ValidationException $e) {
            // Log the validation error details
            Log::error('Validation error submitting survey:', [
                'survey_id' => $survey->id,
                'user_id' => $user->id,
                'error_message' => $e->getMessage(),
                'errors' => $e->errors(),
            ]);

            // Redirect back with validation error messages
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log any other errors
            Log::error('Error submitting survey:', [
                'survey_id' => $survey->id,
                'user_id' => $user->id,
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with a general error message
            return redirect()->back()->with('error', 'An error occurred while submitting your responses. Please try again.');
        }
    }

    public function results(Survey $survey)
    {
        $results = [];
        $totalResponses = $survey->entries()->count();

        foreach ($survey->sections as $section) {
            $sectionResults = [];
            foreach ($section->questions as $question) {
                $answers = [];
                if ($question->type === 'multiselect') {
                    foreach ($question->answers as $answer) {
                        // Split each answer by comma and trim whitespace
                        $splitAnswers = array_map('trim', explode(',', $answer->value));
                        $answers = array_merge($answers, $splitAnswers);
                    }
                } else {
                    // For other types (radio, text, number, etc.)
                    $answers = $question->answers()->pluck('value')->toArray();
                }

                $sectionResults[] = [
                    'question' => $question->content,
                    'type' => $question->type,
                    'options' => $question->options,
                    'answers' => $answers,
                ];
            }
            $results[] = [
                'section' => $section->name,
                'questions' => $sectionResults
            ];
        }

        return view('survey.edit-survey.results', compact('survey', 'results', 'totalResponses'));
    }
}
