const clientSupps = document.querySelectorAll('.clientSupp');
const gmsAffaire = document.getElementById('gms_affaire');
const miAffaire = document.getElementById('mi_affaire');
const mgAffaire = document.getElementById('mg_affaire');

clientSupps.forEach((clientSupp)=>{

  clientSupp.addEventListener('click',(e)=>{
    if (!confirm('Voulez vous vraiment supprimer le client ?')) {
          e.preventDefault();
    }
  })
});

gmsAffaire.addEventListener('keyup',(e)=>{
  if (parseInt(e.target.value) === 1205) {
    gmsAffaire.nextElementSibling.style.display = "block";
    const siteURL = "http://178.238.238.52:8083/api/gmsSites/omag_38_GROUPE%20MONDIAL%20SERVICE/1205";

    fetch(siteURL)
                  .then((response)=>{
                    return response.json();
                  })
                  .then(data=>{
                   const select = gmsAffaire.nextElementSibling;
                    // console.log(data)
                    data.forEach((site)=>{
                      const option = document.createElement('option');
                      option.value = site.Id_site;
                      option.innerHTML = site.Nom;

                      
                      select.appendChild(option);

                    })
                  })

  }else{
    gmsAffaire.nextElementSibling.style.display = "none";
  }


});

miAffaire.addEventListener('keyup',(e)=>{

});

mgAffaire.addEventListener('keyup',(e)=>{

});
  