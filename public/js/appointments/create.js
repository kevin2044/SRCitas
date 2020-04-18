let $doctor, $specialty, $date, $hours;
let iRadio;
const noHoursAlert = `<div class="alert alert-danger" role="alert">
    <strong>Lo sentimos!</strong> No se encontraton horas disponibles para el médico en el día seleccionado.
</div>`;
$(function () {
    $specialty = $('#specialty_id');
    $doctor = $('#doctor_id');
    $date = $('#date');
    $hours = $('#hours');
    $specialty.change(function () {
        const specialtyId = $specialty.val();
        const url = `/api/specialties/${specialtyId}/doctors`;
        $.getJSON(url, onDoctorLoaded);
    });

    $doctor.change(loadHours);
    $date.change(loadHours);

    function onDoctorLoaded(doctors) {
        let htmlOptions = '';
        doctors.forEach(function (doctor) {
            htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`;
        });

        $doctor.html(htmlOptions);
        loadHours(); //side-affect
    }

    function loadHours(){
        const selectedDate = $date.val()
        const doctorId = $doctor.val()
        const url = `/api/schedule/hours?date=${selectedDate}&doctor_id=${doctorId}`;
        $.getJSON(url, displayHours);
    }

    function displayHours(data){
        if(!data || !data.morning || !data.afternoon){
            $hours.html(noHoursAlert);
            return;
        }
        let htmlHours = '';
        iRadio = 0;
        if(data.morning){
            const morning_intervals = data.morning;
            morning_intervals.forEach(interval => {
                htmlHours += getRadioIntervalHtml(interval);
            });
        }
        if(data.afternoon){
            const afternoon_intervals = data.afternoon;
            afternoon_intervals.forEach(interval => {
                htmlHours += getRadioIntervalHtml(interval);
            });
        }

        $hours.html(htmlHours);
    }

    function getRadioIntervalHtml(interval){
        const text = `${interval.start} - ${interval.end}`;
        return `<div class="custom-control custom-radio mb-3">
                    <input type="radio" id="interval${iRadio}" name="scheduled_time" class="custom-control-input" value="${interval.start}" required>
                    <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
                </div>`;
    }
});
