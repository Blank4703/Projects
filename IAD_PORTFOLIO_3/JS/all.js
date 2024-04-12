document.addEventListener('DOMContentLoaded', function() {
  let sub = document.querySelectorAll('.popup');
  sub.forEach(function(element) {
    element.addEventListener('click', function() {
      let dis = this.parentElement.querySelector('.hide');
      dis.style.display = 'block';
      this.style.display = 'none';
      let button1 = this.parentElement.querySelector('.popless');
      button1.style.display = 'block';
    });
  });
  
  let less = document.querySelectorAll('.popless');
  less.forEach(function(element) {
    element.addEventListener('click', function() {
      let d = this.parentElement.querySelector('.hide');
      d.style.display = 'none';
      let b = this.parentElement.querySelector('.popup');
      b.style.display = 'block';
      this.style.display = 'none';
    });
  });
});