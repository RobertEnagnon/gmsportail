
const tickSupps = document.querySelectorAll('.tickSupp');

tickSupps.forEach((tickSupp)=>{

 tickSupp.addEventListener('click',(e)=>{
   if (!confirm('Voulez vous vraiment supprimer le ticket ?')) {
         e.preventDefault();
   }
 })
});