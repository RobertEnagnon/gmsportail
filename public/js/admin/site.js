

    const siteSupp = document.querySelectorAll('.siteSupp');

   siteSupp.forEach((siteSupp)=>{
   
    siteSupp.addEventListener('click',(e)=>{
      if (!confirm('Voulez vous vraiment supprimer le Site ?')) {
            e.preventDefault();
      }
    })
   });