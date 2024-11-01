export function convertToGermanDate(dateString) {
    const [year, month, day] = dateString.split('-');
    return `${day}.${month}.${year}`;
}

export function convertToISODate(germanDate) {
    const [day, month, year] = germanDate.split('.');
    return `${year}-${month}-${day}`;
}
