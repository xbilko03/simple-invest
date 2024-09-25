/*
* Name         : apiService.js
* Project      : Simple Invest
* Description  : API script to send API requests to the server
*
* Author       : xbilko03
*/
const API_BASE_URL = 'http://localhost:3001/trading/';
const API_KEY = 'security-key-69420';

const handleError = async (response) => 
{
  const errorText = await response.text();
  console.error('API error: ', errorText);
  throw new Error(`API error: ${errorText}`);
};

export async function testFetch(type)
{
  try 
  {
    const url = `${API_BASE_URL}get.php?type=${type}`;
    const response = await fetch(url, {headers: {'X-API-KEY': API_KEY},});

    if (response.ok == false)
    {
      await handleError(response);
    }

    return await response.json();
  }
  catch (error)
  {
    console.error('Request failed: ', error.message);
    throw new Error(`Request failed: ${error}`);
  }
}
