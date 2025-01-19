        // إظهار أو إخفاء حقل رقم الغرفة بناءً على الدور المحدد
        document.querySelector('select[name="role"]').addEventListener('change', function() {
            const roomNumField = document.getElementById('roomNumField');
            if (this.value === 'user') {
                roomNumField.style.display = 'block';
            } else {
                roomNumField.style.display = 'none';
            }
        });
