function formatDateAndTime(dateTimeString) {
  const date = new Date(dateTimeString);
  const month = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];

  let meridiem = date.getHours() > 12 ? "PM" : "AM";
  
  console.log(date.getHours())
  const getDate = date.getDate() < 10 ? `0${date.getDate()}` : date.getDate();

  const dateString = `${
    month[date.getMonth()]
  } ${getDate} ${date.getFullYear()}`;
  const timeString = `${date.getHours()}:${date.getMinutes()} ${meridiem}`;

  const fullDateTimeString = `${dateString} at ${timeString}`

  return fullDateTimeString;
}
