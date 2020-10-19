export default function unixToDate(time)
{
	const milliseconds = time * 1000 // 1575909015000

	const dateObject = new Date(milliseconds)

	const humanDateFormat = dateObject.toLocaleString()

	// console.log("Date: ", humanDateFormat);
	return humanDateFormat;
}