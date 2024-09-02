var arr_hinh=[
    "http://andylongstore.com/storage/banner.jpg",
    "https://www.duchuymobile.com/images/promo/34/s20-plus-pc-banner.jpg",
    "https://vj360.vn/wp-content/uploads/2023/03/Xiaomi-Redmi-Note-12-Pro-Plus-ava.jpeg",
    "https://cdn.pico.vn/Files/2021/10/25/18673_dien-thoai-oppo.jpg",
    "https://theme.hstatic.net/200000136511/1000604100/14/col_banner_img3.jpg?v=384",
    "https://thepixel.vn/wp-content/uploads/Vivo-Y33s-5G-sap-duoc-ra-mat-tai-Trung-Quoc-voi-man-hinh-giot-nuoc-muc-gia-tu-56-trieu-dong.-1024x491.png",
    "https://cdn.tgdd.vn/Files/2020/06/07/1261474/nokia-5-3-1_800x450_800x450.jpg",
];
var index=0;
function prev(){
index--;
if(index<0) index=arr_hinh.length-1;
document.getElementById("hinh").src=arr_hinh[index];
}
function next(){
index++;
if(index==arr_hinh.length) index=0;
document.getElementById("hinh").src=arr_hinh[index];
}
setInterval("next()", 3000);
// function tang(x) {
//   var cha = x.parentElement;
//   var soluongcu = cha.children[1];
//   var soluongmoi = parseInt(soluongcu.innerText)+1;
//   soluongcu.innerText=soluongmoi;
// }
// function giam(x) {
//   var cha = x.parentElement;
//   var soluongcu = cha.children[1];
//   if (parseInt(soluongcu.innerText)-1>0) {
//   var soluongmoi = parseInt(soluongcu.innerText)-1;
//   soluongcu.innerText=soluongmoi;
// }
// }
var imgFeature = document.querySelector('.img-feature')
var listImg = document.querySelectorAll('.list-image img')
var prevBtn = document.querySelector('.prev')
var nextBtn = document.querySelector('.next')

var currentIndex = 0;
function updateImageByIndex(index) {
    document.querySelectorAll('.list-image div').forEach(item=>{
        item.classList.remove('active-img')
    })
    currentIndex = index
    imgFeature.src = listImg[index].getAttribute('src')
    listImg[index].parentElement.classList.add('active-img')
}
listImg.forEach((imgElement, index)=>{
    imgElement.addEventListener('click', e=>{
    imgFeature.computedStyleMap.opacity = '0'
    setTimeout(()=> {
        updateImageByIndex(index)     
        imgFeature.style.opacity = '1'
    }, 400)    
    })
})

prevBtn.addEventListener('click', e=>{
    if (currentIndex==0) {
        currentIndex = listImg.length - 1
    } else {
currentIndex--
}
imgFeature.style.animation = ''
setTimeout(()=> {
    updateImageByIndex(currentIndex)
    imgFeature.style.animation = 'slideLeft 1s ease-in-out forwards;'
}, 200) 
})
nextBtn.addEventListener('click', e=>{
    if (currentIndex == listImg.length - 1) {
        currentIndex = 0
    } else {
currentIndex++
}
imgFeature.style.animation = ''
setTimeout(()=> {
    updateImageByIndex(currentIndex)
    imgFeature.style.animation = 'slideRight 1s ease-in-out forwards;'
}, 200) 
})
updateImageByIndex(0)


var modal = document.getElementById('id01');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content-click");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
  function checkTextArea() {
    event.preventDefault();
    var textareaValue = document.getElementById("textarea_id").value; 
    if (textareaValue.trim().length === 0) {
      alert("Vui lòng nhập bình luận.");
    }
  }