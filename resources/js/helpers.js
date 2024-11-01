export function convertToGermanDate(dateString) {
    if (!dateString) return;
    const [year, month, day] = dateString.split('-');
    return `${day}.${month}.${year}`;
}

export function convertToISODate(germanDate) {
    if (!germanDate) return;

    const [day, month, year] = germanDate.split('.');
    return `${year}-${month}-${day}`;
}
