const clientSupps = document.querySelectorAll('.clientSupp');

   clientSupps.forEach((clientSupp)=>{
   
    clientSupp.addEventListener('click',(e)=>{
      if (!confirm('Voulez vous vraiment supprimer le client ?')) {
            e.preventDefault();
      }
    })
   });
  