<!-- resources/views/layouts/footer-landingpage.blade.php -->
<style>
    .footer {
        background-color: #0F1F3E;
        color: white;
        padding: 20px 0; /* Adjust padding for better spacing */
        border-radius: 50px 50px 0 0;
        font-size: 0.9rem; /* Smaller font size */
    }

    .footer-logo img {
        height: 50px; /* Adjust logo size */
    }

    .footer-text {
        font-size: 0.9rem; /* Reduce text size */
        line-height: 1.4;
        margin-top: 10px;
    }

    .footer-social {
        text-align: center;
        padding-top: 10px; /* Adjust padding */
    }

    .social-icon {
        color: white;
        font-size: 1.8rem; /* Reduce icon size */
        margin: 0 10px; /* Equal spacing between icons */
        text-decoration: none;
    }

    .social-icon:hover {
        color: #d9fa07; /* Hover effect */
    }

    @media (max-width: 768px) {
        .footer-logo,
        .footer-text,
        .footer-social {
            text-align: center; /* Center-align on smaller screens */
        }

        .footer-social {
            padding-top: 15px; /* Adjust padding for smaller screens */
        }
    }
</style>

<div class="footer">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Logo and Text Column -->
            <div class="col-md-6 text-md-start text-center footer-logo">
                <img src="{{ asset('images/imm.png') }}" alt="IMM Logo" class="logo-footer">
                <p class="footer-text">
                    Impact Measurement and Management <br>
                    (TBN INDONESIA X MAXY ACADEMY)
                </p>
            </div>

            <!-- Social Icons Column -->
            <div class="col-md-6 text-md-end text-center footer-social">
                <a href="https://www.facebook.com" target="_blank" class="social-icon">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://www.instagram.com/tbn.indonesia" target="_blank" class="social-icon">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.linkedin.com/in/tbn-indonesia-210705251/" target="_blank" class="social-icon">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>
    </div>
</div>
