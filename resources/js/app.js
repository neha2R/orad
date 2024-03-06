$(document).ready(function () {
    $(".nav-toggler").each(function (_, navToggler) {
        var target = $(navToggler).data("target");
        $(navToggler).on("click", function () {
            $(target).animate({
                height: "toggle"
            }, 500);
        });
    });
});

//hide alert after 5 sec.
setTimeout(function () {
    $(".alert").slideUp();
    $(".alertParent").removeClass('-mb-20');
}, 50000);

$(document).ready(function () {
    $('.personal-goals').owlCarousel({
        stagePadding: 0,
        loop: true,
        margin: 10,
        nav: true,
        dots:false,
        freeDrag:true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
    $('.dynamicCourses').owlCarousel({
        stagePadding: 0,
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        freeDrag: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        },
        // center:true
    });
    $('.carriculum').owlCarousel({
        stagePadding: 80,
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        freeDrag: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        },
        // center:true
    });
    $('.courses').owlCarousel({
        stagePadding: 50,
        loop: true,
        margin: 10,
        nav: false,
        dots:false,
        freeDrag:true,
        autoplay: true,
        autoplayTimeout: 1000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    
    $('.clients').owlCarousel({
        stagePadding: 0,
        loop: true,
        margin: 10,
        nav: true,
        dots:false,
        freeDrag:true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        },
        // center:true
    });
    
    $('.employe-of-the-month').owlCarousel({
        stagePadding: 0,
        loop: true,
        margin: 10,
        nav: true,
        dots:false,
        freeDrag:true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        },
        // center:true
    });
    
    $('.tutor').owlCarousel({
        stagePadding: 50,
        loop: true,
        margin: 10,
        nav: true,
        dots:false,
        freeDrag:true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        },
        center:true
    });
});

const counters = document.querySelectorAll(".counter");

function runCounter() {
    counters.forEach(counter => {
        counter.innerText = 0;
        let target = counter.dataset.count;
        
        let countIt = function () {
            let displayedCount = +counter.innerText;
            if(displayedCount < target){
                counter.innerText = displayedCount + 1;
                setTimeout(countIt, 25);
            }else{
                counter.innerText = target;
            }
        }

        countIt();
    })
}

let counterSection = document.querySelector(".counterSection");
let options = {
    rootMargin: '0px 0px -180px 0px'
};
let isPlayed = false;
if (counterSection){
    const sectionObjserver = new IntersectionObserver(function (entries) {
        if (entries[0].isIntersecting && !isPlayed) {
            isPlayed = true;
            let leftProgress = document.querySelectorAll(".circle .left .progress");
            let rightProgress = document.querySelectorAll(".circle .right .progress");
            let blueCircle = document.querySelector(".blueCircle");
            let redCircle = document.querySelector(".redCircle");
            let yellowCircle = document.querySelector(".yellowCircle");
            blueCircle.style.transform = "rotate(180deg)";
            blueCircle.style.zIndex = "3";
            redCircle.style.transform = "rotate(165deg)";
            redCircle.style.zIndex = "3";
            yellowCircle.style.transform = "rotate(155deg)";
            yellowCircle.style.zIndex = "3";
            
            leftProgress.forEach(left => {
                left.style.zIndex = "1";
                left.style.animation = "left 2s linear both";
            })
            rightProgress.forEach(right => {
                right.style.animation = "right 2s linear both";
                right.style.animationDelay = "2s";
            })
           
            runCounter();
        }
    }, options);
    
    sectionObjserver.observe(counterSection);

}

// card one top of the one
function cardswipe() {
    const cardContainer = document.querySelector(".card-container");
    const cards = document.querySelectorAll(".card");
    const allCards = cards.length;
    let index = 0;
    cards.forEach(value => {
        // console.log(value);
        index++;
        const top = index * 3;
        const right = index * 3;
        value.className += `top-${top} `;
        value.className += `right-${right}`;

        const hammertime = new Hammer(value);
        const actions = "pan" //hammertime.get('pan').set({ direction: Hammer.DIRECTION_ALL });

        
        hammertime.on(actions, function (ev) {
            // console.log(ev, value);
            value.style.transform = `scale(.9) translate(${ev.deltaX}px, ${ev.deltaY}px) rotate(${(ev.deltaX * ev.deltaY) / (value.offsetWidth * value.offsetHeight) * 90}deg)`
            value.classList.add('moving');

            value.classList.toggle('ok', ev.deltaY > 0);
            value.classList.toggle('ko', ev.deltaY < 0);
            
            // check if all cards z index value is -1 then update it to 0 
            /**
             * allCardsZindexValue 0 = false
             * allCardsZindexValue 1 = true
             */
            let allCardsZindexValue = 0;
            if (!allCardsZindexValue) {
                cards.forEach(singleCard => {
                    if (singleCard.style.zIndex == '-1') {
                        allCardsZindexValue = 1;
                    }
                });
            }

            // if allCardsZindexValue == 1 then update all value 
            if (allCardsZindexValue) {
                cards.forEach(singleCard => {
                    singleCard.style.zIndex = '0';
                });
            }


            if (ev.isFinal) {
                // console.log("if part",ev.isFinal);
                if (Math.abs(ev.deltaX) > (value.offsetWidth * 0.9 / 3)) {
                    // value.style.display = 'none'
                    value.style.transform = '';
                    value.style.zIndex = '-1';
                    value.classList.remove('moving')
                }else {
                    value.style.transform = '';
                    // value.style.zIndex = '0';
                    value.classList.remove('moving')
                }
            }
        })


    })

}


function cardswipe2() {
    var bioImg = document.getElementsByClassName("card"),
        bioImgLen = bioImg.length,
        counter = bioImgLen,
        tl = new TimelineLite();
    // console.log(bioImgLen);
    // Set image positons
    for (var i = 0; i < bioImgLen; i++) {
        bioImg[i].style.transform = "rotate(" + Math.random() * (2 - 0) + 0 + "deg)";
    }

    // Get a reference to an element
    var wrap = document.getElementById("card-container"),
        // Create a manager to manager the element
        HamMangr = new Hammer.Manager(wrap),
        // Create a recognizer
        Swipe = new Hammer.Swipe();
    // Add the recognizer to the manager
    HamMangr.add(Swipe, { direction: Hammer.DIRECTION_HORIZONTAL });

    HamMangr.on("swipeup swiperight swipedown swipeleft", function (e) {

        counter--;
        if (counter <= 0) {
            // console.log(bioImgLen);
            // bioImgLen=8;
            for (var i = 0; i < bioImgLen; i++) {
                // console.log("call");
                tl.to(wrap.children[i], 0.25, { y: 0, x: 0, rotation: 0, ease: Expo.easeOut });
            }
            // Reset counter
            counter = bioImgLen;
        } else {
            // console.log("call2");

            tl.add(slideOutAnim(HamMangr.input.element.children[counter], e.type, 1));
        }

    });

    // Greensock animation
    function slideOutAnim(element, swipeDir, timeDuration) {
        // console.log(element);
        var xDistance = element.clientWidth * 1.5;
        var yDistance = element.clientHeight * 1.5;
        var soa = new TimelineLite(),
            vars = {
                rotation: 180,
                ease: Expo.easeOut
            };

        switch (swipeDir) {
            case "swiperight":
                vars.x = xDistance;
                break;
            case "swipeleft":
                vars.x = -xDistance;
                break;
            case "swipeup":
                vars.y = -yDistance;
                break;
            case "swipedown":
                vars.y = yDistance;
                break;
            default:
                // console.log("swipe direction error");
        }
        soa.to(element, timeDuration, vars);

        return soa;
    }
}


//swipe card Initialize
let windowSmallScreen = window.matchMedia("(max-width: 700px)");
$(document).ready(function(){
    
    if (windowSmallScreen.matches) {
        cardswipe();
    }
})

// modal close and open script 
const modalSelected = document.querySelector('.scholarshipModal');
if (modalSelected != null) {
    modalSelected.classList.remove('fadeIn');
    modalSelected.classList.add('fadeOut');
    modalSelected.style.display = 'none';
    
}
function modalClose() {
    const modalToClose = document.querySelector('.scholarshipModal');
    modalToClose.classList.remove('fadeIn');
    modalToClose.classList.add('fadeOut');
    setTimeout(() => {
        modalToClose.style.display = 'none';
    }, 500);
}

function openModal(){
    const modalToOpen = document.querySelector('.scholarshipModal');
    modalToOpen.classList.remove('fadeOut');
    modalToOpen.classList.add('fadeIn');
    modalToOpen.style.display = 'flex';
}

$(document).ready(function () {
    var isRegisterd = $("#isRegisterd").value();
    // console.log(isRegisterd);
    if (!isRegisterd){
        openModal();
    }
});