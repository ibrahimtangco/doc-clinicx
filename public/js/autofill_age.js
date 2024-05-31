// birthday age
        const birthday = document.querySelector('#birthday');
        const ageField = document.querySelector('#age');

        birthday.addEventListener('change', () => {
            const selectedDate = new Date(birthday.value);
            const today = new Date();
            let age = today.getFullYear() - selectedDate.getFullYear();

            // Adjust age if birthday for this year hasn't occurred yet
            if (today.getMonth() < selectedDate.getMonth() || (today.getMonth() === selectedDate.getMonth() && today.getDate() < selectedDate.getDate())) {
                age--;
            }

            // Set the value of the age field as the calculated age
            ageField.value = age.toString();
        });
