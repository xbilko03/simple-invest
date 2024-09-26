/*
 * Name         : ApiService.ts
 * Project      : Simple Invest
 * Description  : API script to send API requests to the server
 *
 * Author       : xbilko03
 */

const API_BASE_URL = 'http://localhost:3001/trading/';
const API_KEY = 'security-key-69420';

interface ApiResponse
{
  success?: boolean;
  data?: any;
  message?: string;
  error?: string;
}

const handleError = async (response: Response): Promise<void> =>
{
    const errorText = await response.text();
    console.error('API error: ', errorText);
    throw new Error(`API error: ${errorText}`);
};

export async function testFetch(type: string): Promise<ApiResponse>
{
    try
    {
        const url = `${API_BASE_URL}get.php?type=${type}`;
        const response = await fetch(url, { headers: { 'X-API-KEY': API_KEY, }, });

        if (!response.ok)
        {
            await handleError(response);
        }

        return await response.json() as ApiResponse;
    }
    catch (error)
    {
        console.error('Request failed: ', error);
        throw new Error(`Request failed: ${error}`);
    }
}
