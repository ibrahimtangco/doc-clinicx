const deleteBtns = document.querySelectorAll('.delete-btn');
            const confirmDeleteModal = document.querySelector('#popup-delete-modal');
            const closeModalBtn = document.querySelector('#close-delete-modal');
            const confirmDeleteBtn = document.querySelector('#confirm-delete');
            const cancelBtn = document.querySelector('#cancel-btn')
            let formToSubmit;

            function openModal(form) {
                formToSubmit = form;
                confirmDeleteModal.classList.remove('hidden');
                confirmDeleteModal.classList.add('flex');
            }

            function closeModal() {
                confirmDeleteModal.classList.add('hidden');
                confirmDeleteModal.classList.remove('flex');
            }

            closeModalBtn.addEventListener('click', closeModal);

            deleteBtns.forEach(btn => {
                btn.addEventListener('click', (event) => {
                    event.preventDefault();
                    const form = btn.closest('.delete-form');
                    openModal(form);
                });
            });

            confirmDeleteBtn.addEventListener('click', () => {
                formToSubmit.submit();
            });

            cancelBtn.addEventListener('click', () => {
                   confirmDeleteModal.classList.add('hidden');
                confirmDeleteModal.classList.remove('flex');
            })

            console.log(cancelBtn)
