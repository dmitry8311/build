document.addEventListener("DOMContentLoaded", (event) => {
    function findAllSiblings(element) {
        let siblings = [];
        let sibling = element.parentNode.firstChild;

        // Loop through each sibling and push to the array
        while (sibling) {
            if (sibling.nodeType === 1 && sibling !== element) {
                siblings.push(sibling);
            }
            sibling = sibling.nextSibling;
        }

        return siblings;
    }

    document.querySelectorAll('.block_locations__locations_map svg circle').forEach(circle => {
        "click mouseover".split(" ").forEach(function(e){
            circle.addEventListener(e, function (event) {
                let cards = document.querySelectorAll('[data-id="card-' + event.target.id+'"]');
                if (cards.length > 0) {
                    cards.forEach(card => {
                        const siblings = findAllSiblings(card);
                        siblings.forEach(sibling => {
                            sibling.classList.remove('block_locations__location--active');
                        });
                        card.classList.add('block_locations__location--active');
                    });
                }
            });
        });
    });
});
