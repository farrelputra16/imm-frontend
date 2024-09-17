<!-- resources/views/layouts/footer-landingpage.blade.php -->
<style>
    .footer {
        background-color: #5940CB;
        color: white;
        padding: 5px 5px;
        position: relative;
        overflow: hidden;
        border-radius: 50px 50px 0 0;
        z-index: 10;
        font-size: 0.9rem; /* Smaller font size */
    }
    .footer-logo img {
        height: 40px; /* Smaller logo */
        margin-bottom: 5px;
    }
    .footer-text {
        font-size: 0.9rem; /* Reduce text size */
        line-height: 1.4;
        margin-top: 5px;
    }
    .footer-social {
        text-align: end;
        padding-top: 10px; /* Less padding */
    }
    .social-icon {
        color: white;
        font-size: 1.8rem; /* Reduce icon size */
        margin-right: 15px;
        text-decoration: none;
    }
    .social-icon:hover {
        color: #d9fa07;
    }
    @media (max-width: 768px) {
        .footer {
            text-align: center;
        }
        .footer-social {
            text-align: center;
            padding-top: 15px; /* Adjust padding for smaller screens */
        }
    }
</style>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-start footer-logo">
                <img src="{{ asset('images/imm.png') }}" alt="IMM Logo" class="logo-footer">
                <p class="footer-text">
                    Impact Measurement and Management <br>
                    (TBN INDONESIA X MAXY ACADEMY)
                </p>
            </div>
            <div class="col-md-6 text-end footer-social">
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
