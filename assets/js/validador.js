$(function() {
    /*
    Alfanumerico: A-Z, a-z, 0-9 y espacios
    Numerico: 0-9
    Alfabetico: A-Z, a-z y espacios
    Decimal: 0-9 y punto decimal    
    */
    
    $( ".validarNumerico" ).keyup(function(element) {
        this.value = this.value.trim();        
        var value = this.value;        
        if(value !== ''){           
            if(/^\d*[1-9]\d*$/.test(value)){
                $(this).removeClass('is-invalid');
            }else{
                $(this).addClass('is-invalid');
            }            
           }
               else{
                   $(this).removeClass('is-invalid');
        }
    });
    
     $( ".validarAlfaNumerico" ).keyup(function(element) {         
         this.value = this.value.split(/\s+/).join(' ');
         var value = this.value.trim();        
         
         if(value.length === 0){
             this.value = value;
         }
         
        if(value !== ''){           
            if(/^[a-zA-Z0-9 ]*$/.test(value)){
                $(this).removeClass('is-invalid');
            }else{
                $(this).addClass('is-invalid');
            }            
           }
               else{
                   $(this).removeClass('is-invalid');
        }
    });
    
    $( ".validarAlfaNumericoExtendido" ).keyup(function(element) {         
         this.value = this.value.split(/\s+/).join(' ');
         var value = this.value.trim();        
         
         if(value.length === 0){
             this.value = value;
         }
         
        if(value !== ''){           
            if(/^[a-zA-Z0-9 \-]*$/.test(value)){
                $(this).removeClass('is-invalid');
            }else{
                $(this).addClass('is-invalid');
            }            
           }
               else{
                   $(this).removeClass('is-invalid');
        }
    });
    
    $( ".validarAlfabetico" ).keyup(function(element) {         
         this.value = this.value.split(/\s+/).join(' ');
         var value = this.value.trim();        
         
         if(value.length === 0){
             this.value = value;
         }
         
        if(value !== ''){           
            if(/^[a-zA-Z ]*$/.test(value)){
                $(this).removeClass('is-invalid');
            }else{
                $(this).addClass('is-invalid');
            }            
           }
               else{
                   $(this).removeClass('is-invalid');
        }
    });
    
    /*$(':submit').click(function(){
        var invalidElements = $('.is-invalid').length;
        
        if(invalidElements > 0){
            alert('Hay errores');
            return false;
        }        
    });*/
    
    
     $("form").submit(function(e){
          var invalidElements = $('.is-invalid').length;
        
        if(invalidElements > 0){
            alert('Hay errores');
            e.preventDefault(e);
            return false;
        }   
            });
    
    
});