document.addEventListener('DOMContentLoaded', function() {
  const successAlert = document.getElementById('successAlert');
  if(successAlert) {
      setTimeout(function() {
          successAlert.style.animation = 'fadeOut 1s forwards';
          setTimeout(function() {
              successAlert.style.display = 'none';
          }, 1000);
      }, 3000);
  }

});
