
    const docuSupps = document.querySelectorAll('.docuSupp');

    docuSupps.forEach((docuSupp)=>{
    
     docuSupp.addEventListener('click',(e)=>{
       if (!confirm('Voulez vous vraiment supprimer le document ?')) {
             e.preventDefault();
       }
     })
    });