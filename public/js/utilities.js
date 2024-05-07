function ageComputer(birthdate) {
  const currentDate = new Date();
  years = currentDate.getFullYear() - birthdate.getFullYear();
  
  if (
    birthdate.getMonth() > currentDate.getMonth() ||
    (birthdate.getDate() > currentDate.getDate() &&
      birthdate.getMonth() > currentDate.getMonth()) ||
    (birthdate.getMonth() === currentDate.getMonth() &&
      birthdate.getDate() > currentDate.getDate())
  ) {
    years = years - 1;
  }

  return years;
}
