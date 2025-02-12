document.addEventListener("DOMContentLoaded", () => {
    function triggerUpdate() {
        let queryArgs = {
            action: 'filter_posts',
            post_type: 'projects',
            category_ids: [],
            service_ids: [],
            technology_ids: [],
            region_ids: [],
        }

        document.querySelectorAll('[name="category-filter[]"]:checked').forEach(function (checkedBox) {
            queryArgs.category_ids.push(checkedBox.value);
        });
        document.querySelectorAll('[name="service-filter[]"]:checked').forEach(function (checkedBox) {
            queryArgs.service_ids.push(checkedBox.value);
        });
        document.querySelectorAll('[name="technology-filter[]"]:checked').forEach(function (checkedBox) {
            queryArgs.technology_ids.push(checkedBox.value);
        });
        document.querySelectorAll('[name="region-filter[]"]:checked').forEach(function (checkedBox) {
            queryArgs.region_ids.push(checkedBox.value);
        });


        let requestBody = Object.keys(queryArgs).map(function(key) {
            if(Array.isArray(queryArgs[key])) {
                return key + '=' + queryArgs[key].join(',');
            }

            return key + '=' + queryArgs[key];
        }).join('&');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/wp-admin/admin-ajax.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                let container = document.getElementById('block-project-loop__slider-content');
                let $container = jQuery(container);
                $container.slick('unslick');
                container.innerHTML = xhr.responseText;
                $container.slick();
            }
        };
        xhr.send(requestBody);
    }

    document.querySelectorAll(
        '#block-project-loop__filter [name="category-filter[]"], #block-project-loop__filter [name="service-filter[]"], #block-project-loop__filter [name="technology-filter[]"], #block-project-loop__filter [name="region-filter[]"]'
    ).forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            triggerUpdate();
        });
    });
});
