const stars = document.querySelectorAll('.star');
const star1 = document.querySelector('#star1');
const star2 = document.querySelector('#star2');
const star3 = document.querySelector('#star3');
const star4 = document.querySelector('#star4');
const star5 = document.querySelector('#star5');
const parent1 = star1.parentNode;
const parent2 = star2.parentNode;
const parent3 = star3.parentNode;
const parent4 = star4.parentNode;
const parent5 = star5.parentNode;
let checkbox1 = parent1.querySelector('[name="star1"]')
let checkbox2 = parent2.querySelector('[name="star2"]')
let checkbox3 = parent3.querySelector('[name="star3"]')
let checkbox4 = parent4.querySelector('[name="star4"]')
let checkbox5 = parent5.querySelector('[name="star5"]')

    let totalRatings = 0;
        function getValue(star) {
            // Get the parent element of the star element
            const parentElement = star.parentElement;
            const starId = star.id
            // Get the input sibling of the star element
            let inputSiblingCheckBox = parentElement.querySelector('input[type="checkbox"]');
            inputSiblingCheckBox.checked = true;
            if(inputSiblingCheckBox.checked) {
                if(starId == 'star1') {
                    if(totalRatings > 1) {

                        checkbox2.checked = false;
                        checkbox3.checked = false;
                        checkbox4.checked = false;
                        checkbox5.checked = false;
                        star2.classList.remove('fa-solid');
                        star2.classList.add('fa-regular');
                        star3.classList.remove('fa-solid');
                        star3.classList.add('fa-regular');
                        star4.classList.remove('fa-solid');
                        star4.classList.add('fa-regular');
                        star5.classList.remove('fa-solid');
                        star5.classList.add('fa-regular');
                    }

                    star.classList.add('fa-solid');
                    star.classList.remove('fa-regular');
                    totalRatings = 1;
                }
                else if(starId == 'star2') {
                    if(totalRatings > 2) {
                        star3.classList.remove('fa-solid');
                        star3.classList.add('fa-regular');
                        star4.classList.remove('fa-solid');
                        star4.classList.add('fa-regular');
                        star5.classList.remove('fa-solid');
                        star5.classList.add('fa-regular');
                    }
                    star.classList.add('fa-solid');
                    star.classList.remove('fa-regular');
                    star1.classList.add('fa-solid');
                    star1.classList.remove('fa-regular');

                    totalRatings = 2;
                }
                else if(starId == 'star3') {
                    if(totalRatings > 3) {
                        star4.classList.remove('fa-solid');
                        star4.classList.add('fa-regular');
                        star5.classList.remove('fa-solid');
                        star5.classList.add('fa-regular');
                    }

                    star.classList.add('fa-solid');
                    star.classList.remove('fa-regular');
                    star1.classList.add('fa-solid');
                    star1.classList.remove('fa-regular');
                    star2.classList.add('fa-solid');
                    star2.classList.remove('fa-regular');
                    totalRatings = 3;
                }
                else if(starId == 'star4') {
                    if(totalRatings > 4) {
                        star5.classList.remove('fa-solid');
                        star5.classList.add('fa-regular');
                    }
                    star.classList.add('fa-solid');
                    star.classList.remove('fa-regular');
                    star1.classList.add('fa-solid');
                    star1.classList.remove('fa-regular');
                    star2.classList.add('fa-solid');
                    star2.classList.remove('fa-regular');
                    star3.classList.add('fa-solid');
                    star3.classList.remove('fa-regular');
                    totalRatings = 4;
                }
                else if(starId == 'star5') {
                    star.classList.add('fa-solid');
                    star.classList.remove('fa-regular');
                    star1.classList.add('fa-solid');
                    star1.classList.remove('fa-regular');
                    star2.classList.add('fa-solid');
                    star2.classList.remove('fa-regular');
                    star3.classList.add('fa-solid');
                    star3.classList.remove('fa-regular');
                    star4.classList.add('fa-solid');
                    star4.classList.remove('fa-regular');
                    totalRatings = 5;
                }

            }
            else {

            }
            console.log(starId)

            console.log
        }

        stars.forEach(star => {
            star.addEventListener('click', () => {
                getValue(star)
            })
        });

