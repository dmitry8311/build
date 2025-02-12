document.addEventListener("DOMContentLoaded", () => {
    function triggerUpdate() {
        let queryArgs = {
            action: 'filter_posts',
            post_type: 'library-item',
            category_ids: [],
            filter_ids: [],
            types: [],
        }

        document.querySelectorAll('[name="category-filter[]"]:checked').forEach(function (checkedBox) {
            queryArgs.category_ids.push(checkedBox.value);
        });
        document.querySelectorAll('[name="filter-filter[]"]:checked').forEach(function (checkedBox) {
            queryArgs.filter_ids.push(checkedBox.value);
        });
        document.querySelectorAll('[name="type-filter[]"]:checked').forEach(function (checkedBox) {
            queryArgs.types.push(checkedBox.value);
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
                let container = document.getElementById('block-library-loop__slider-content');
                let $container = jQuery(container);
                $container.slick('unslick');
                container.innerHTML = xhr.responseText;
                $container.slick();
            }
        };
        xhr.send(requestBody);
    }

    document.querySelectorAll(
        '#block-library-loop__filter [name="category-filter[]"], #block-library-loop__filter [name="type-filter[]"], #block-library-loop__filter [name="filter-filter[]"]'
    ).forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            triggerUpdate();
        });
    });
});
