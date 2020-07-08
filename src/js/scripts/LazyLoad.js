const imgs = document.querySelectorAll("[data-src]");

// check if browser supports intersection observer 
/* if(!"IntersectionObserver" in window){
        // immediately  load all images
} */
function loadImage(image){
    const source = image.getAttribute("data-src");
    if(!source){
        return;
    }

    image.src = source;

}
const options = {
    threshold: 0,
    rootMargin: "0px 0px 300px 0px" // load images 300px before the viewport
};

const observer = new IntersectionObserver((entries, observer) => {
        
        entries.forEach(entry => {
            if(!entry.isIntersecting){
                  return;

            } else {
                loadImage(entry.target);
                observer.unobserve(entry.target);
            }
        })



}, options);

imgs.forEach(image => {
    observer.observe(image);
});
