<style>
.nav-item {
    margin-right: 10px; /* Adjust margin between nav items */
}

.navbar-brand {
    font-size: 20px; /* Adjust navbar brand font size */
    font-weight: bold; /* Make navbar brand text bold */
}
.navbar-nav{
        margin: 0 20px;
    }
.nav-link,
.navbar-button {
    color: #000000;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.nav-link:hover,
.navbar-button:hover {
    background-color: #f0f0f0; /* Light grey background on hover */
}

.navbar-button.active,
.nav-link.active {
    background-color: #5940cb;
    color: #ffffff !important; /* Important to override existing color */
}

.navbar {
    background-color: #ffffff;
    color: #000000;
    padding: 15px 0;
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1000;
    border-bottom: 3px solid #5940cb;
}

.navbar-logo {
    font-size: 24px;
}

.navbar-links {
    list-style-type: none;
    display: flex;
    margin: 0 auto; /* Center the navbar items */
    padding: 0;
}

.navbar-links li {
    margin-right: 20px;
}

.navbar-links li:last-child {
    margin-right: 0;
}

.navbar-links a {
    color: inherit;
    text-decoration: none;
}

.navbar-links a:hover {
    text-decoration: underline;
}

.navbar-actions .btn {
    text-decoration: none;
    color: black;
    padding: 6px 17px;
    border-radius: 8px;
    transition: all 0.3s ease;
    margin: 0 5px;
    display: inline-block;
    font-size: 16px;
}

.navbar-actions .btn-primary {
    background-color: #ffffff21;
    /* Warna latar biru */
    border-color: #6d4ff3cc;
}

.navbar-actions .btn-primary:hover,
.navbar-actions .btn-primary:focus {
    background-color: #a191e7cc;
    /* Warna latar saat hover atau fokus */
    box-shadow: 0 2px 8px rgba(101, 58, 241, 0.6);
    /* Menambah bayangan */
    transform: translateY(-2px);
    /* Bergerak sedikit ke atas saat hover */
}

.navbar-button {
    background-color: #000000;
    color: #ffffff;
    padding: 10px 20px;
    border-radius: 10px;
    border: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
    text-decoration: none;
    /* Menghapus underline pada teks tautan */
    display: inline-block;
    /* Membuat tautan tampil sebagai blok inline */
}

.navbar-button:hover {
    background-color: #333333;
}

.navbar-actions .btn-outline-primary {
    color: #fdfdff;
    background-color: #5940cb;
    border: 2px solid #5940cb;
}

.navbar-actions .btn-outline-primary:hover,
.navbar-actions .btn-outline-primary:focus {
    color: white;
    /* Warna teks saat hover atau fokus */
    background-color: #5940cb;
    /* Latar belakang biru saat hover atau fokus */
    transform: translateY(-2px);
    /* Bergerak sedikit ke atas saat hover */
    box-shadow: 0 2px 8px rgba(108, 52, 211, 0.6);
    /* Menambah bayangan */
}

.navbar-actions .btn:active {
    transform: translateY(1px);
    /* Bergerak sedikit ke bawah saat diklik */
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>




<script>
    // JavaScript for toggling active class on navbar links/buttons
    $(document).ready(function() {
        $('.nav-link, .navbar-button').click(function() {
            $('.nav-link, .navbar-button').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
