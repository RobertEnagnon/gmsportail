
const emplSupps = document.querySelectorAll('.emplSupp');

emplSupps.forEach((emplSupp)=>{

 emplSupp.addEventListener('click',(e)=>{
   if (!confirm('Voulez vous vraiment supprimer l\'employé ?')) {
         e.preventDefault();
   }
 })
});