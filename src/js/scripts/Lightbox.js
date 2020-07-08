class Lightbox {
    constructor(targetClass){
        
        this.containers = document.querySelectorAll(`div.${targetClass}`)
        

        this.links = []
        this.containers.forEach( (e) =>{

            this.links.push(e.querySelector(`a`))
        })
        
      this.targetClass = targetClass
    }
    init() {
      if (this.containers.length > 0) this.createLightbox()
    
     
   
     this.initEvent()
      
    }
    initEvent(){
        Array.from(this.links).forEach((el) => {
      
            el.addEventListener('click', (ev) => this.lightbox(el,ev) )
    })
    }
    createLightbox(){
       
      const div = document.createElement('div')
      div.setAttribute('id','starter-theme-lightbox')
      const content = document.createElement('div')
      content.setAttribute('id','starter-theme-lightbox-content')
      const close = document.createElement('div')
      close.setAttribute('id','starter-theme-close')
      close.innerHTML+="X"
      content.appendChild(close)
      div.appendChild(content)
      document.body.appendChild(div)
  }
  removeImg(){

  }
  lightbox(element, event){
   
    event.preventDefault()
    const lbox = document.getElementById('starter-theme-lightbox')
    const link = element.href
    const img = document.createElement('img')
    img.src = link
    const light = document.getElementById('starter-theme-lightbox-content')
    light.appendChild(img)
    document.getElementById('starter-theme-lightbox').className = 'starter-theme_open'
    if(lbox !== null){
      document.getElementById('starter-theme-close').addEventListener('click', function(){
      
        if(img !== null) light.removeChild(img)
         lbox.className = ''
        
          
      }, {once: true})
    }  
    if(lbox !== null){
        document.getElementById('starter-theme-lightbox').addEventListener('click', function(e){
            if(e.target.id === 'starter-theme-lightbox'){
            e.preventDefault()
          
            light.removeChild(img)
            lbox.className = ''
            
            }
          
       }, {once: true})
    }
      

      
  }

}
export default Lightbox