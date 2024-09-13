document.addEventListener("DOMContentLoaded", function () {
    var metricItems = document.querySelectorAll(".metric-item");

    metricItems.forEach(function (item) {
        item.addEventListener("click", function () {
            var checkbox = item.querySelector(".metric-checkbox");
            checkbox.checked = !checkbox.checked;
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        var loading = document.getElementById("loading");
        loading.style.display = "none"; // Menghilangkan efek loading setelah waktu tunggu
    }, 1000); // 3000 milidetik = 3 detik
});
