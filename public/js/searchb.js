function searchBrand(){
    var input=document.querySelector("#searchBrand");
    var inuptVal=input.value.toUpperCase();
    var brands=document.querySelectorAll(".liBrand");
    var labelVal;

    brands.forEach(element=> {
            labelVal=element.querySelector('label').innerText.toUpperCase();
            if (labelVal.indexOf(inuptVal)>-1) {
                element.style.display="";
            }else{
                element.style.display="none";
            }
        }
    );
}
