document.addEventListener("DOMContentLoaded", () => {
    function triggerUpdate() {
        let selectedLocations = [];
        document.querySelectorAll('[name="location-filter[]"]:checked').forEach(function (checkedBox) {
            selectedLocations.push(checkedBox.value);
        });

        let selectedDepartments = [];
        document.querySelectorAll('[name="department-filter[]"]:checked').forEach(function (checkedBox) {
            selectedDepartments.push(checkedBox.value);
        });

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/wp-admin/admin-ajax.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                let container = document.getElementById('block-job-loop__slider-content');
                let $container = jQuery(container);
                $container.slick('unslick');
                container.innerHTML = xhr.responseText;
                $container.slick();
            }
        };
        xhr.send('action=filter_posts&post_type=job&location_ids=' + selectedLocations.join(',') + '&department_ids=' + selectedDepartments.join(','));
    }

    document.querySelectorAll('[name="location-filter[]"], [name="department-filter[]"]').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            triggerUpdate();
        });
    });
});
