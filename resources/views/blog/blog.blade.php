@extends('layouts.app-imm')
@section('title', 'Artikel')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body,
        html {
            font-family: "Roboto", sans-serif;
            height: 100%;
            padding-top: 30px;
        }
        .btn:hover{
            color: white;
        }
.title{
    
}
        .form-control {
            width: 60%;
        }

        .btn-ungu{
            background-color: #5940cb;
            color:white;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-container input {
            padding: 10px;
            border: 2px solid #5940cb;
            border-radius: 5px 0 0 5px;
            font-size: 16px;
        }

        .search-container button {
            border: 2px solid #5940cb;
            border-left: none;
            padding: 5px 20px;
            background-color: #5940cb;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            color: #fff;
            font-size: 16px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .blog-card {
    color: #010101;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    min-height: 400px;
    text-align: left;
    flex: 0 0 30%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan untuk efek elevasi */
}

.blog-card a {
    text-decoration: none;
    color: inherit;
}

.blog-card .blog-image {
    height: 150px;
    background-size: cover;
    background-position: center;
    margin-bottom: 20px;
    border-radius: 5px;
}

.blog-card h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
    min-height: 3em;
}

.blog-card p {
    font-size: 1rem;
    line-height: 1.5;
    flex-grow: 1;
    margin-bottom: 15px; /* Jarak bawah antara paragraf dan judul */
}

        .pagination-container {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .pagination-container p {
            font-size: 16px;
        }

        .subscribe-container {
            background: #f0f0ff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-top: 30px;
        }

        .subscribe-container p {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        @media only screen and (max-width: 992px) {
            .blog-card {
                flex: 0 0 48%;
                /* Two columns for tablets */
            }
        }

        @media only screen and (max-width: 768px) {
            .blog-card {
                flex: 0 0 90%;
                /* Full width for mobile */
                padding: 15px;
            }
        }

        .no-blogs-message {
            text-align: center;
            font-size: 1.2rem;
            color: #999;
            margin-top: 50px;
        }
    </style>
@endsection

@section('content')

    <div class="container mt-5">
        <h5 class="text-center mb-5" style="margin-top: 70px">Temukan wawasan tentang dampak baru disini</h5>
        <div class="search-container">
            <input type="text" class="form-control" placeholder="Cari disini" id="searchInput">
            <button onclick="searchBlog()" class="btn-search"><i class="fas fa-search"></i></button>
        </div>
        <div class="row mt-5" id="blogContainer">
            <!-- Blog cards will be inserted here by JavaScript -->
        </div>
        <div id="noBlogsMessage" class="no-blogs-message py-3 border" style="display: none;">
            Belum ada artikel.
        </div>
        <div class="pagination-container">
            <button id="prevPageBtn" class="btn btn-secondary mr-2" disabled>Sebelumnya</button>
            <button id="nextPageBtn" class="btn btn-ungu">Berikutnya</button>
            <p class="ml-2 mt-3">Halaman <span id="currentPage">1</span> dari <span id="totalPages"></span></p>
        </div>

        <script>
            const backendUrl = @json($backendUrl);
            const posts = @json($posts);

            document.addEventListener("DOMContentLoaded", function () {
                const blogContainer = document.getElementById("blogContainer");
                const noBlogsMessage = document.getElementById("noBlogsMessage");
                const postsPerPage = 6;
                const totalPages = Math.ceil(posts.length / postsPerPage);
                let currentPage = 1;

                function showPosts(page) {
                    const startIndex = (page - 1) * postsPerPage;
                    const endIndex = startIndex + postsPerPage;
                    const currentPosts = posts.slice(startIndex, endIndex);

                    blogContainer.innerHTML = '';

                    currentPosts.forEach((post) => {
                        const blogCard = document.createElement("div");
                        blogCard.className = "blog-card";
                        blogCard.innerHTML = `
                            <a href="/blogarticle/${post.id}/view" class="text-left">
                                <div class="blog-image" style="background-image: url(${post.img});"></div>
                                <h3 class="title ">${post.title}</h3>
                                <p>${post.content}</p>
                            </a>
                        `;
                        blogContainer.appendChild(blogCard);
                    });

                    if (currentPosts.length === 0) {
                        noBlogsMessage.style.display = "block";
                    } else {
                        noBlogsMessage.style.display = "none";
                    }

                    document.getElementById("currentPage").textContent = page;
                    currentPage = page;
                    updatePaginationButtons();
                }

                function updatePaginationButtons() {
                    const totalPages = Math.ceil(posts.length / postsPerPage);
                    document.getElementById("totalPages").textContent = totalPages;

                    if (currentPage > 1) {
                        document.getElementById("prevPageBtn").disabled = false;
                    } else {
                        document.getElementById("prevPageBtn").disabled = true;
                    }

                    if (currentPage < totalPages) {
                        document.getElementById("nextPageBtn").disabled = false;
                    } else {
                        document.getElementById("nextPageBtn").disabled = true;
                    }
                }

                showPosts(1);

                document.getElementById("nextPageBtn").addEventListener("click", function () {
                    if (currentPage < Math.ceil(posts.length / postsPerPage)) {
                        showPosts(currentPage + 1);
                    }
                });

                document.getElementById("prevPageBtn").addEventListener("click", function () {
                    if (currentPage > 1) {
                        showPosts(currentPage - 1);
                    }
                });

                document.getElementById("searchInput").addEventListener("input", searchBlog);
            });

            function searchBlog() {
                const input = document.getElementById("searchInput").value.toLowerCase();
                const blogCards = document.querySelectorAll(".blog-card");
                const noBlogsMessage = document.getElementById("noBlogsMessage");
                let found = false;

                blogCards.forEach((card) => {
                    const title = card.querySelector("h3").textContent.toLowerCase();
                    const content = card.querySelector("p").textContent.toLowerCase();
                    if (title.includes(input) || content.includes(input)) {
                        card.style.display = "block";
                        found = true;
                    } else {
                        card.style.display = "none";
                    }
                });

                if (found) {
                    noBlogsMessage.style.display = "none";
                } else {
                    noBlogsMessage.style.display = "block";
                }
            }
        </script>
    </div>
@endsection
