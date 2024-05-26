const modalContent = document.querySelector('#confirmation-modal');
        const modalBtns = document.querySelectorAll('.modal-btn');
        const hideModalBtn = document.querySelector('#hide-modal-btn');

        const confirmSubmitBtn = document.querySelector('#confirm-submit-btn');
        let form = '';

        // let confirmServiceId = document.querySelector('#confirmServiceId');
        let confirmServiceName = document.querySelector('#confirmServiceName');
        let confirmDate = document.querySelector('#confirmDate');
        let confirmTime = document.querySelector('#confirmTime');

        function formatTimeTo12Hour(time) {
            // Split the time into hours and minutes
            let [hour, minute] = time.split(':').map(Number);

            // Determine am or pm
            let period = hour >= 12 ? 'pm' : 'am';

            // Convert hour from 24-hour to 12-hour format
            hour = hour % 12 || 12; // Convert hour '0' to '12' for 12 AM and 12 PM

            // Return the formatted time
            return `${hour}:${minute.toString().padStart(2, '0')} ${period}`;
        }
        modalBtns.forEach(btn => {
            btn.addEventListener('click', ()=> {
                form = btn.closest('form');

                let serviceId = form.querySelector('#service_id').value;
                let serviceName = form.querySelector('#service_name').value;
                let date = form.querySelector('#date').value;
                let time = form.querySelector('#time').value;

                let dateString = date;
                let dateObject = new Date(dateString);

                let daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                let monthsOfYear = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                let dayOfWeek = daysOfWeek[dateObject.getDay()];
                let month = monthsOfYear[dateObject.getMonth()];
                let dayOfMonth = dateObject.getDate();
                let year = dateObject.getFullYear();

                let formattedTime = formatTimeTo12Hour(time);
                let formattedDate = dayOfWeek + ', ' + month + ' ' + dayOfMonth + ', ' + year;

                if(modalContent.classList.contains('hidden')) {
                    modalContent.classList.remove('hidden');
                    modalContent.classList.add('flex');

                // confirmServiceId.innerText = serviceId;
                confirmDate.innerText = formattedDate;
                confirmTime.innerText = formattedTime;
                confirmServiceName.innerText = serviceName;
                }
                else {
                    modalContent.classList.remove('flex');
                    modalContent.classList.add('hidden');
                }
            })
        });


        confirmSubmitBtn.addEventListener('click', ()=> {
            form.submit();
        })

        hideModalBtn.addEventListener('click', () => {
            modalContent.classList.remove('flex');
            modalContent.classList.add('hidden');
        })
