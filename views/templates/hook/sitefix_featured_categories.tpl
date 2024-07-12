<style>
.caroussel-container{
    overflow: hidden;
    position: relative;
    max-width: 1200px;
    margin: auto;
}
.flex_container{
    display: flex;
    transition: transform 0.5s ease-in-out;
}
.flex_container.wrap{
    flex-wrap: wrap;
}
.categories_name{
    color:#5d6d76;
    margin-top:20px;
    text-align: center;
    text-transform: lowercase;
}

.caroussel-container .caroussel-itens.round{
    width: 140px;
    margin-right: 20px;
    text-align: center;
}

.caroussel-container .caroussel-itens.round img {
    width: 100px;
    height: 100px;
    border:1px solid lightgray;
    padding:10px;
    border-radius: 100px;
    background-color: #f1f4f3;
}
.caroussel-container .caroussel-itens.round .categories_name{
    font-size: 12px !important;
    font-weight: bold;
    text-transform:capitalize;
    text-align: center;
    line-height: 20px;
}
.caroussel-container .caroussel-itens.square{
    width: 200px;
    min-width: 200px;
    margin-right: 20px;
    text-align: center;
    padding: 10px;
    border:1px solid lightgray;
    min-height: 218px;
    border-radius: 10px;
}
.caroussel-container .caroussel-itens.square img {
  width:120px;
  min-height:120px;
  height:120px
}
.caroussel-container .caroussel-itens.square.categories_name{
    text-transform: capitalize;
}


.caroussel-container .caroussel-itens.two{
    border:0.50px solid lightgray;
    width:276px;
    height: 148px;
    padding:30px
}

.caroussel-container .caroussel-itens.two button{
    width: 100px;
}
.caroussel-container .caroussel-itens.two img{
    width: 80px;
    height: 80px;
    min-width: 80px;
    min-height: 80px;
    object-fit: cover;
    margin-right: 5px;
}
.caroussel-container .caroussel-itens.two .categories_name{
    font-weight: bold;
    color:black;
    font-size:12px;
    line-height: 19px;
    text-transform: capitalize;
}



.title_button{
    display: flex;
    justify-content:space-between;
    margin-top:50px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid lightgray;
}
.title_button button:hover{
    background-color:#008ecc;
    color:white
}
.title_button button{
    background-color: #ecf0ef;
    border:none;
    color:gray;
    border-radius: 100%;
    height: 40px;
    width: 40px;
 
}
.PLUS{
    display: flex;
    justify-content: space-between;
    
}
.PLUS button{
    width: 100px;
    border:none;
    margin-top:10px;
    font-size:13px
}
.caroussel-container .caroussel-itens.square {
  width: 120px;
  min-width: 120px;
  margin-right: 20px;
  text-align: center;
  padding: 4px;
  border: 1px solid lightgray;
  min-height: 120px;
  border-radius: 10px;
  height: 100px;
}
.caroussel-container .caroussel-itens.square img {
  width: 50px;
  min-height: 50px;
  height: 50px;
  object-fit: contain;
}
.categories_name {
  color: #5d6d76;
  margin-top: 20px;
  text-align: center;
  text-transform: lowercase;
  font-size: 12px;
}
</style>


<div class="title_button">
    <div>
        <h3>{$SECTION_TITLE}</h3>
    </div>
    {if $FEATURED_LAYOUT == 1}
    <div>
        <button class="button button_prev"> < </button>
        <button class="button button_next"> > </button> 
    </div>
    {/if}
  
</div>
<div class="caroussel-container">
   
<div class="flex_container {if $FEATURED_LAYOUT == 2 || $FEATURED_LAYOUT == 3}wrap {/if} ">
            {foreach from=$sitefix_ft_cat item=category name=cat}
                
                <div class="caroussel-itens {if $FEATURED_LAYOUT == 3} round {elseif  $FEATURED_LAYOUT == 1}
                     square {else} two{/if}">
                    <div>
                        <a href="{$category["url"]}" class="" tabindex="-1">
                            <div class="">
                     <div class="{if $FEATURED_LAYOUT == 2} PLUS {/if}">
                                    <img src="{$category['image']}" class="" >
                                    <div class="categories_name">{$category['name']}
                                        {if $FEATURED_LAYOUT ==  2}
                                                <button class="">Voir plus</button>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            {/foreach}
        </div>
   
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      
        const track = document.querySelector('.flex_container');
        const items = document.querySelectorAll('.caroussel-itens');
        const prevButton = document.querySelector('.button_prev');
        const nextButton = document.querySelector('.button_next');
        const itemWidth = items[0].offsetWidth;
        let currentIndex = 0;
;
        function updateCarousel() {
            track.style.transform = "translateX(-" + (currentIndex * itemWidth) + "px)";
        }

        function hideButton(){
            if(currentIndex == 0){
                prevButton.style.display = "none";
            }else{
                prevButton.style.display = "inline-block";
            }
        }
       
        prevButton.addEventListener('click', function() {
           
            if (currentIndex > 0) {
              
                currentIndex--;
                updateCarousel();
                hideButton();
            }
           
        });

        nextButton.addEventListener('click', function() {
          
            if (currentIndex < items.length - 4) {
                
                currentIndex++;
                updateCarousel();
                hideButton();
            }
          
        });
    });
</script>
</body>
</html>
