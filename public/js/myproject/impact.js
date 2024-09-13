document.addEventListener("DOMContentLoaded", (event) => {
    const initialData = [2300, 4100, 6100, 4200, 7000, 6500, 6000];

    const ctx = document.getElementById("myChart").getContext("2d");
    const myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
            ],
            datasets: [{
                label: "Bahan baku yang diolah kembali (kg)",
                data: initialData.slice(),
                backgroundColor: "rgba(103, 58, 183, 0.6)",
                borderColor: "rgba(103, 58, 183, 1)",
                borderWidth: 1,
            }, ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    // Fungsi untuk memperbarui data grafik
    const updateChartData = () => {
        const inputs = document.querySelectorAll(".input-row input");
        const newData = Array.from(inputs).map(
            (input) => parseInt(input.value) || 0
        );
        myChart.data.datasets[0].data = newData;
        myChart.update();
    };

    // Menambahkan event listener pada input
    document.querySelectorAll(".input-row input").forEach((input) => {
        input.addEventListener("input", updateChartData);
    });

    // Menambahkan event listener untuk slider
    const slider = document.getElementById("myRange");
    slider.addEventListener("input", function() {
        const value = slider.value;
        document.querySelectorAll(".input-row input").forEach((input) => {
            input.value = value;
        });
        updateChartData();
    });

    // Menambahkan event listener untuk tombol Reset Data
    document
        .querySelector(".btn-outline-primary")
        .addEventListener("click", () => {
            document
                .querySelectorAll(".input-row input")
                .forEach((input, index) => {
                    input.value = initialData[index] || 0;
                });
            slider.value = 5000; // Mengatur slider ke nilai default
            updateChartData();
        });

    // Menambahkan event listener untuk tombol Simpan Data
    document.querySelector(".btn-primary").addEventListener("click", () => {
        alert("Data berhasil disimpan!");
    });
});