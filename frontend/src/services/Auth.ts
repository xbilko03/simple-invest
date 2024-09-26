/*
 * Name         : Auth.ts
 * Project      : Simple Invest
 * Description  : API script to ensure the user authentication
 *
 * Author       : xbilko03
 */

import axios from 'axios';

export interface User
{
    id: string;
    username: string;
    role: string;
}

interface AuthResponse
{
    success: boolean;
    user?: User;
}

/* Function to authenticate the user */
export async function authenticateUser(username: string, password: string): Promise<User | null>
{
    try
    {
        const response = await axios.post<AuthResponse>('http://localhost:3001/trading/authenticate.php', 
        {
            username, 
            password
        }, 
        {
            headers: { 'x-api-key': 'security-key-69420' }
        });

        if (response.data.success && response.data.user) 
        {
            return response.data.user;
        }
        else
        {
            return null;
        }
    }
    catch (error)
    {
        console.error('Authentication error: ', error);
        return null;
    }
}
