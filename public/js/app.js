/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

$(document).ready(function () {
  $(".nav-toggler").each(function (_, navToggler) {
    var target = $(navToggler).data("target");
    $(navToggler).on("click", function () {
      $(target).animate({
        height: "toggle"
      }, 500);
    });
  });
}); //hide alert after 5 sec.

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
    }
  });
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
    } // center:true

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
    } // center:true

  });
  $('.courses').owlCarousel({
    stagePadding: 50,
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    freeDrag: true,
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
    } // center:true

  });
  $('.employe-of-the-month').owlCarousel({
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
    } // center:true

  });
  $('.tutor').owlCarousel({
    stagePadding: 50,
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
    center: true
  });
});
var counters = document.querySelectorAll(".counter");

function runCounter() {
  counters.forEach(function (counter) {
    counter.innerText = 0;
    var target = counter.dataset.count;

    var countIt = function countIt() {
      var displayedCount = +counter.innerText;

      if (displayedCount < target) {
        counter.innerText = displayedCount + 1;
        setTimeout(countIt, 25);
      } else {
        counter.innerText = target;
      }
    };

    countIt();
  });
}

var counterSection = document.querySelector(".counterSection");
var options = {
  rootMargin: '0px 0px -180px 0px'
};
var isPlayed = false;

if (counterSection) {
  var sectionObjserver = new IntersectionObserver(function (entries) {
    if (entries[0].isIntersecting && !isPlayed) {
      isPlayed = true;
      var leftProgress = document.querySelectorAll(".circle .left .progress");
      var rightProgress = document.querySelectorAll(".circle .right .progress");
      var blueCircle = document.querySelector(".blueCircle");
      var redCircle = document.querySelector(".redCircle");
      var yellowCircle = document.querySelector(".yellowCircle");
      blueCircle.style.transform = "rotate(180deg)";
      blueCircle.style.zIndex = "3";
      redCircle.style.transform = "rotate(165deg)";
      redCircle.style.zIndex = "3";
      yellowCircle.style.transform = "rotate(155deg)";
      yellowCircle.style.zIndex = "3";
      leftProgress.forEach(function (left) {
        left.style.zIndex = "1";
        left.style.animation = "left 2s linear both";
      });
      rightProgress.forEach(function (right) {
        right.style.animation = "right 2s linear both";
        right.style.animationDelay = "2s";
      });
      runCounter();
    }
  }, options);
  sectionObjserver.observe(counterSection);
} // card one top of the one


function cardswipe() {
  var cardContainer = document.querySelector(".card-container");
  var cards = document.querySelectorAll(".card");
  var allCards = cards.length;
  var index = 0;
  cards.forEach(function (value) {
    // console.log(value);
    index++;
    var top = index * 3;
    var right = index * 3;
    value.className += "top-".concat(top, " ");
    value.className += "right-".concat(right);
    var hammertime = new Hammer(value);
    var actions = "pan"; //hammertime.get('pan').set({ direction: Hammer.DIRECTION_ALL });

    hammertime.on(actions, function (ev) {
      // console.log(ev, value);
      value.style.transform = "scale(.9) translate(".concat(ev.deltaX, "px, ").concat(ev.deltaY, "px) rotate(").concat(ev.deltaX * ev.deltaY / (value.offsetWidth * value.offsetHeight) * 90, "deg)");
      value.classList.add('moving');
      value.classList.toggle('ok', ev.deltaY > 0);
      value.classList.toggle('ko', ev.deltaY < 0); // check if all cards z index value is -1 then update it to 0 

      /**
       * allCardsZindexValue 0 = false
       * allCardsZindexValue 1 = true
       */

      var allCardsZindexValue = 0;

      if (!allCardsZindexValue) {
        cards.forEach(function (singleCard) {
          if (singleCard.style.zIndex == '-1') {
            allCardsZindexValue = 1;
          }
        });
      } // if allCardsZindexValue == 1 then update all value 


      if (allCardsZindexValue) {
        cards.forEach(function (singleCard) {
          singleCard.style.zIndex = '0';
        });
      }

      if (ev.isFinal) {
        // console.log("if part",ev.isFinal);
        if (Math.abs(ev.deltaX) > value.offsetWidth * 0.9 / 3) {
          // value.style.display = 'none'
          value.style.transform = '';
          value.style.zIndex = '-1';
          value.classList.remove('moving');
        } else {
          value.style.transform = ''; // value.style.zIndex = '0';

          value.classList.remove('moving');
        }
      }
    });
  });
}

function cardswipe2() {
  var bioImg = document.getElementsByClassName("card"),
      bioImgLen = bioImg.length,
      counter = bioImgLen,
      tl = new TimelineLite(); // console.log(bioImgLen);
  // Set image positons

  for (var i = 0; i < bioImgLen; i++) {
    bioImg[i].style.transform = "rotate(" + Math.random() * (2 - 0) + 0 + "deg)";
  } // Get a reference to an element


  var wrap = document.getElementById("card-container"),
      // Create a manager to manager the element
  HamMangr = new Hammer.Manager(wrap),
      // Create a recognizer
  Swipe = new Hammer.Swipe(); // Add the recognizer to the manager

  HamMangr.add(Swipe, {
    direction: Hammer.DIRECTION_HORIZONTAL
  });
  HamMangr.on("swipeup swiperight swipedown swipeleft", function (e) {
    counter--;

    if (counter <= 0) {
      // console.log(bioImgLen);
      // bioImgLen=8;
      for (var i = 0; i < bioImgLen; i++) {
        // console.log("call");
        tl.to(wrap.children[i], 0.25, {
          y: 0,
          x: 0,
          rotation: 0,
          ease: Expo.easeOut
        });
      } // Reset counter


      counter = bioImgLen;
    } else {
      // console.log("call2");
      tl.add(slideOutAnim(HamMangr.input.element.children[counter], e.type, 1));
    }
  }); // Greensock animation

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

      default: // console.log("swipe direction error");

    }

    soa.to(element, timeDuration, vars);
    return soa;
  }
} //swipe card Initialize


var windowSmallScreen = window.matchMedia("(max-width: 700px)");
$(document).ready(function () {
  if (windowSmallScreen.matches) {
    cardswipe();
  }
}); // modal close and open script 

var modalSelected = document.querySelector('.scholarshipModal');

if (modalSelected != null) {
  modalSelected.classList.remove('fadeIn');
  modalSelected.classList.add('fadeOut');
  modalSelected.style.display = 'none';
}

function modalClose() {
  var modalToClose = document.querySelector('.scholarshipModal');
  modalToClose.classList.remove('fadeIn');
  modalToClose.classList.add('fadeOut');
  setTimeout(function () {
    modalToClose.style.display = 'none';
  }, 500);
}

function openModal() {
  var modalToOpen = document.querySelector('.scholarshipModal');
  modalToOpen.classList.remove('fadeOut');
  modalToOpen.classList.add('fadeIn');
  modalToOpen.style.display = 'flex';
}

$(document).ready(function () {
  var isRegisterd = $("#isRegisterd").value(); // console.log(isRegisterd);

  if (!isRegisterd) {
    openModal();
  }
});

/***/ }),

/***/ "./resources/scss/app.scss":
/*!*********************************!*\
  !*** ./resources/scss/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/developer.scss":
/*!***************************************!*\
  !*** ./resources/scss/developer.scss ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					result = fn();
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/developer": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) var result = runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/developer","css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	__webpack_require__.O(undefined, ["css/developer","css/app"], () => (__webpack_require__("./resources/scss/app.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/developer","css/app"], () => (__webpack_require__("./resources/scss/developer.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;