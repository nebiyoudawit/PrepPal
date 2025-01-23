// Handle likes toggle
document.querySelector('.likes').addEventListener('click', function() {
    const likedIcon = this.querySelector('.liked-state');
    const notLikedIcon = this.querySelector('.notliked-state');
    const likeCount = this.querySelector('span');
    
    // Toggle visibility of liked and not liked icons
    if (notLikedIcon.style.display === 'none') {
      notLikedIcon.style.display = 'inline';
      likedIcon.style.display = 'none';
      likeCount.textContent = parseInt(likeCount.textContent) - 1;  // Decrease count when unliked
    } else {
      notLikedIcon.style.display = 'none';
      likedIcon.style.display = 'inline';
      likeCount.textContent = parseInt(likeCount.textContent) + 1;  // Increase count when liked
    }
  });
  
  // Handle saves toggle
  document.querySelector('.saves').addEventListener('click', function() {
    const savedIcon = this.querySelector('.saved-state');
    const notSavedIcon = this.querySelector('.notsaved-state');
    const saveText = this.querySelector('span');
    
    // Toggle visibility of saved and not saved icons
    if (notSavedIcon.style.display === 'none') {
      notSavedIcon.style.display = 'inline';
      savedIcon.style.display = 'none';
      saveText.textContent = 'Save';  // Change text to "Save" if not saved
    } else {
      notSavedIcon.style.display = 'none';
      savedIcon.style.display = 'inline';
      saveText.textContent = 'Saved';  // Change text to "Saved" if saved
    }
  });
  