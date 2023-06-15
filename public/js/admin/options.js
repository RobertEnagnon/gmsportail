

const serviceSupp = document.querySelectorAll('.serviceSupp');

serviceSupp.forEach((service)=>{

 service.addEventListener('click',(e)=>{
   if (!confirm('Voulez vous vraiment supprimer le service ?')) {
         e.preventDefault();
   }
 })
});

const prioritesSupp = document.querySelectorAll('.prioritesSupp');

prioritesSupp.forEach((priorite)=>{

 priorite.addEventListener('click',(e)=>{
   if (!confirm('Voulez vous vraiment supprimer le priorite ?')) {
         e.preventDefault();
   }
 })
});

const typesDocSupp = document.querySelectorAll('.typesDocSupp');

typesDocSupp.forEach((type)=>{

 type.addEventListener('click',(e)=>{
   if (!confirm('Voulez vous vraiment supprimer le type ?')) {
         e.preventDefault();
   }
 })
});


