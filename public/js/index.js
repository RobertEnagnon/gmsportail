const sideMenu = document.querySelector('aside');
const menuBtn = document.querySelector('#menu-btn');
const closeBtn = document.querySelector('#close-btn');
const themeToggler = document.querySelector(".theme-toggler");

// show sidebar
menuBtn.addEventListener('click',e=>{
    sideMenu.style.display = "block";
});

// close sidebar
closeBtn.addEventListener('click', e=>{
    sideMenu.style.display = "none";
})

// change theme
themeToggler.addEventListener("click", e =>{
    document.body.classList.toggle('dark-theme-variables');
    // themeToggler.querySelector("span").classList.toggle('active');
    themeToggler.querySelector("span:nth-child(1)").classList.toggle('active');
    themeToggler.querySelector("span:nth-child(2)").classList.toggle('active');
})

// Fiil orders in table
orders.forEach(order => {
    const tr = document.createElement('tr');
    const trContent = `
                        <td>${order.productName}</td>
                        <td>${order.productNumber}</td>
                        <td>${order.payementStatus}</td>
                        <td class="${order.Shipping==='Déclinée' ? 'danger' : order.
                        Shipping==='En attente' ? 'warning' : 'primary'}">
                        ${order.Shipping}</td>
                        <td class="primary">Details</td>
                    `;
                    tr.innerHTML = trContent;
                    document.querySelector("table tbody").appendChild(tr);
})