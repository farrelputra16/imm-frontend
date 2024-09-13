document.addEventListener("DOMContentLoaded", function() {
    var sdgItems = document.querySelectorAll(".sdg-item");

    sdgItems.forEach(function(item) {
        item.addEventListener("click", function() {
            var description = item.querySelector(".sdg-description");
            var toggle = item.querySelector(".sdg-toggle");

            if (description.style.display === "block") {
                description.style.display = "none";
                toggle.classList.remove("fa-chevron-up");
                toggle.classList.add("fa-chevron-down");
                item.classList.remove("active");
            } else {
                description.style.display = "block";
                toggle.classList.remove("fa-chevron-down");
                toggle.classList.add("fa-chevron-up");
                item.classList.add("active");
            }
        });
    });
});

function saveSelectedSDGs() {
    var selectedSDGs = [];
    document.querySelectorAll(".sdg-checkbox:checked")
        .forEach(function(checkbox) {
            selectedSDGs.push(checkbox.value);
        });
    localStorage.setItem("selectedSDGs", JSON.stringify(selectedSDGs));
}

document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        var loading = document.getElementById("loading");
        loading.style.display = "none"; // Menghilangkan efek loading setelah waktu tunggu
    }, 1000); // 3000 milidetik = 3 detik
});