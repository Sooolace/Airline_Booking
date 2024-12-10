function calculateDuration() {
    const departTime = new Date(document.getElementById('departing-date').value + 'T' + document.getElementById('depart-time').value);
    const arrivalTime = new Date(document.getElementById('arrival-date').value + 'T' + document.getElementById('arrival-time').value);

    if (!isNaN(departTime.getTime()) && !isNaN(arrivalTime.getTime())) {
        const durationInMilliseconds = arrivalTime - departTime;
        const durationInMinutes = durationInMilliseconds / (1000 * 60);

        const hours = Math.floor(durationInMinutes / 60);
        const minutes = Math.round(durationInMinutes % 60);

        document.getElementById('duration').value = hours + ' hours ';
    }
}
