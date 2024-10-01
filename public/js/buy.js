



function showDetails (id) {

    var arrow_button = document.getElementById("test"+id);
    var content = document.getElementById(id);

        

        if(content.style.display == "block"){
            console.log("if")
            content.style.display = "none";
            arrow_button.classList.add("fa-arrow-down");
            arrow_button.classList.remove("fa-arrow-up");
        }
        else {
            console.log("else")
            document.querySelectorAll('.payment-details').forEach((elem)=>{
                elem.style.display = "none"
               })
           document.querySelectorAll('.icone').forEach((elem)=>{
            elem.classList.add("fa-arrow-down");
        })
            content.style.display = "block";
            arrow_button.classList.add("fa-arrow-up");
            arrow_button.classList.remove("fa-arrow-down");

         
        }

  


    

    
  };