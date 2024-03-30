document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-button');

        // // Find the element with the class 'example'
        // var element = document.querySelector('.example');

        // // Modify its background color
        // element.style.backgroundColor = 'red';

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.closest('form').id.replace('deleteForm', '');
            const confirmation = confirm('Are you sure you want to delete this product?');
            
            if (confirmation) {
                document.getElementById(`deleteForm${productId}`).submit();
            }
        });
    });
});
