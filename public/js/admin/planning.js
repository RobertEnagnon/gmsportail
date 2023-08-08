
const planSupps = document.querySelectorAll('.planSupp');

planSupps.forEach((planSupp)=>{

    planSupp.addEventListener('click',(e)=>{
   if (!confirm('Voulez vous vraiment supprimer le document ?')) {
         e.preventDefault();
   }
 })
});

const repeatCheck = document.querySelector('#repete');
let repeateContainer = document.getElementById('repeateContainer');

repeatCheck.addEventListener('change',function(event){
      if (this.checked) {
            repeateContainer.style.height = 'auto';
            repeateContainer.style.visibility = "visible";
            repeateContainer.style.transition = "all 0.5s ease";
      }else{
            repeateContainer.style.visibility = "hidden";
            repeateContainer.style.height = 0;
            repeateContainer.style.transition = "all 0.5s ease";
      }
})

if (repeatCheck.checked) {
      repeateContainer.style.height = 'auto';
      repeateContainer.style.visibility = "visible";
      repeateContainer.style.transition = "all 0.5s ease";
}

const reteption1 = document.getElementById('reteption1');
const seTermineLe = document.getElementById('se_termine_le');
const reteption2 = document.getElementById('reteption2');
const setermineApres = document.getElementById('se_termine_apres');

reteption1.addEventListener('click', function(){
      seTermineLe.removeAttribute("disabled");
      setermineApres.setAttribute('disabled','true')
})

reteption2.addEventListener('click', function(){
      setermineApres.removeAttribute("disabled");
      seTermineLe.setAttribute('disabled','true')
})