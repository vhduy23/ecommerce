(function() {
  
    var input              = document.getElementById('password');
    var form               = document.getElementById('form');
    var elem               = document.createElement('div');
        elem.id            = 'notify';
        elem.style.display = 'none';
  
        form.appendChild(elem);
  
    input.addEventListener('invalid', function(event){
      event.preventDefault();
      if ( ! event.target.validity.valid ) {
        input.className    = 'invalid animated shake';
        elem.textContent   = 'Phải chứa ít nhất một số và một chữ cái viết hoa và viết thường và ít nhất 8 ký tự trở lên';
        elem.className     = 'error';
        elem.style.display = 'block';
      }
    });
  
    input.addEventListener('input', function(event){
      if ( 'block' === elem.style.display ) {
        input.className = '';
        elem.style.display = 'none';
      }
    });
  
  })();