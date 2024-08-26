<?php
include 'db/db-connect.php';
$assets = 'assets/';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$user_id = 123; // Replace with the actual user ID
$_SESSION['user_id'] = $user_id;
?>
<html>
<?php

require_once 'header.php';
?>

<main role="main">

    <!-- <section class="jumbotron text-center">
        <div class="container">


        </div>
    </section> -->

    <div class="container my-5">
        <h1 class="text-center">Our Products</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <img src="<?php echo $assets . 'img/product.jpg'?>">
                        <p class="card-text">Description of Product 1.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                            </div>
                            <small class="text-muted">3 mins</small>
                        </div>
                        <hr>
                        <h5>Add Comment</h5>
                        <form action="save.php" method="post" id="comment-form">
                            <input type="hidden" name="product_id" value="1">
                            <div class="form-group">
                                <textarea name="comment" class="form-control" rows="3"
                                    placeholder="Enter your comment"></textarea>
                            </div>


                            <hr>
                            <h5>Rate this product</h5>
                            <div class="form-group">
                                <textarea name="review" class="form-control" rows="3"
                                    placeholder="Enter your review"></textarea>
                            </div>
                            <div class=" d-flex justify-content-center mt-5">
                                <div class=" text-center mb-5">
                                    <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label
                                            for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label
                                            for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label
                                            for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label
                                            for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label
                                            for="1">☆</label> </div>
                                </div>
                            </div><input name="save" type="hidden" value="save">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <div class="container my-5">
                            <h2 class="mb-4">Comments/Reviews</h2>
                            <div class="row" id="comments-container">
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
    </div>
</main>
<script>
document.getElementById('comment-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    console.log('clicked')
    fetch('save.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
              fetchProductData(1);
            } else {
                alert('Error saving comment/review. Please try again.');
            }
        })
        .catch(error => {
            alert('An error occurred. Please try again later.');
            console.error('Error:', error);
        });
});

function fetchProductData(productId) {
    fetch(`product.php?id=${productId}`)
        .then(response => response.json())
        .then(data => {
            var commentsContainer = document.getElementById("comments-container");
            data.forEach(function(item) {
                var commentCard = createCommentCard(item);
                commentsContainer.appendChild(commentCard);
            });
        })
        .catch(error => {
            console.error('Error fetching product data:', error);
        });
}

function createCommentCard(data, isEditing = false) {
    var existingCard = document.querySelector(`[data-comment-id="${data.id}"]`);
    if (existingCard) {
        existingCard.remove();
    }

    var card = document.createElement("div");
    card.classList.add("col-md-12", "mb-12");
    card.dataset.commentId = data.id;

    var cardBody = document.createElement("div");
    cardBody.classList.add("card", "border-0", "shadow-sm");

    var cardContent = `
    <div class="card-body">
      <div class="form-group">
        <label for="comment-${data.id}">Comment</label>
        <textarea class="form-control" id="comment-${data.id}" rows="3">${data.comment}</textarea>
      </div>
      <div class="form-group">
        <label for="review-${data.id}">Review</label>
        <input type="text" class="form-control" id="review-${data.id}" value="${data.review}">
      </div>
      <div class="form-group">
        <label for="rating-${data.id}">Rating</label>
        <input type="number" class="form-control" id="rating-${data.id}" value="${data.rating || 0}">
      </div>
      <div class="d-flex justify-content-end">
        <button class="btn btn-primary btn-sm edit-comment" data-comment-id="${data.id}">
          <i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-danger btn-sm remove-comment" data-comment-id="${data.id}">
          <i class="fas fa-trash"></i>
        </button>
      </div>
    </div>
  `;

    cardBody.innerHTML = cardContent;
    card.appendChild(cardBody);
    var removeButton = card.querySelector(".remove-comment");
    removeButton.addEventListener("click", function() {
        removeCommentCard(data.id);
    });
    var editButton = card.querySelector(".edit-comment");
    editButton.addEventListener("click", function() {
        editCommentCard(data.id);
    });
    if (isEditing) {
        card.classList.add("card-editing");
    }

    return card;
}

fetchProductData(1);
function removeCommentCard(commentId) {
    fetch(`delete.php?id=${commentId}`, {
        method: "DELETE"
    })
    .then(response => response.json())
    .then(data => {
        var commentCard = document.querySelector(`[data-comment-id="${commentId}"]`).closest(".col-md-12");
        commentCard.remove();
        console.log(data.message);
    })
    .catch(error => {
        console.error("Error deleting comment:", error);
    });
}

function editCommentCard(commentId) {
    var card = document.querySelector(`[data-comment-id="${commentId}"]`);
    card.classList.add("card-editing");

    var commentInput = card.querySelector(`#comment-${commentId}`);
    var reviewInput = card.querySelector(`#review-${commentId}`);
    var ratingInput = card.querySelector(`#rating-${commentId}`);

    // Save the original values
    commentInput.dataset.originalValue = commentInput.value;
    reviewInput.dataset.originalValue = reviewInput.value;
    ratingInput.dataset.originalValue = ratingInput.value;

    // Add event listeners to save the changes
    commentInput.addEventListener("input", function() {
        updateCommentCard(commentId, this.value, reviewInput.value, ratingInput.value);
    });
    reviewInput.addEventListener("input", function() {
        updateCommentCard(commentId, commentInput.value, this.value, ratingInput.value);
    });
    ratingInput.addEventListener("input", function() {
        updateCommentCard(commentId, commentInput.value, reviewInput.value, this.value);
    });
}

function updateCommentCard(commentId, newComment, newReview, newRating) {
    // Create the request data
    const requestData = {
        id: commentId,
        comment: newComment,
        review: newReview,
        rating: newRating,
    };

    // Send the data to the server using fetch
    fetch("edit.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(requestData),
    })
        .then((response) => response.json())
        .then((data) => {
            // Update the comment data in your backend/database
            // ...

            // Create a new card with the updated data
            const updatedData = {
                id: data.id,
                comment: data.comment,
                review: data.review,
                rating: data.rating,
                created_at: data.created_at,
                updated_at: data.updated_at,
            };
            const newCard = createCommentCard(updatedData, true);

            // Replace the old card with the new card
            const oldCard = document.querySelector(`[data-comment-id="${data.id}"]`);
            oldCard.parentNode.replaceChild(newCard, oldCard);
        })
        .catch((error) => {
            console.error("Error updating comment:", error);
        });
}
</script>
<?php

require_once 'footer.php';
?>
</body>
</body>

</html>