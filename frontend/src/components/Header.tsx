/*
 * Name         : Header.tsx
 * Project      : Simple Invest
 * Description  : Component that provides the user with the logout interface and other features that are common to all components besides Login.tsx
 *
 * Author       : xbilko03
 */
import React from 'react';

const Header: React.FC = () => {

  const handleLogout = () => {
  };

  return (
    <header>
      <h1>Simple Invest</h1>
      <div>
        <span>Welcome</span>
        <button onClick={handleLogout}>Log Out</button>
      </div>
    </header>
  );
};

export default Header;
