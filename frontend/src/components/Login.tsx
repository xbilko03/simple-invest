/*
 * Name         : Login.tsx
 * Project      : Simple Invest
 * Description  : Component that provides the user with the login interface
 *
 * Author       : xbilko03
 */
import React from 'react';

const Login: React.FC = () => {
  return (
    <div>
      <h1>Login</h1>
      <form>
        <div>
          <label htmlFor="username">Username:</label>
          <input type="text" id="username" required />
        </div>
        <div>
          <label htmlFor="password">Password:</label>
          <input type="password" id="password" required />
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  );
};

export default Login;
