 const factSupps = document.querySelectorAll('.factSupp');

   factSupps.forEach((factSupp)=>{
   
    factSupp.addEventListener('click',(e)=>{
      if (!confirm('Voulez vous vraiment supprimer la facture ?')) {
            e.preventDefault();
      }
    })
   });