/*
 * Name         : App.tsx
 * Project      : Simple Invest
 * Description  : Main component for the application
 *
 * Author       : xbilko03
 */
import { Routes, Route, useLocation, Navigate } from 'react-router-dom';
import LoginPage from './components/Login';
import Header from './components/Header';
import AdminDashboard from './components/AdminDashboard';
import UserDashboard from './components/UserDashboard';

const AppRoutes = () => {
  const location = useLocation();
  const showHeader = location.pathname !== '/login';
  return (
    <>
      {showHeader && <Header />}
      <Routes>
        <Route path="/login" element={<LoginPage />} />
        <Route path="/admin" element={<AdminDashboard />}/>
        <Route path="/user/:userId" element={<UserDashboard />}/>
        <Route path="*" element={<Navigate to="/login" replace />} />
      </Routes>
    </>
  );
};

function App() {
  return (
    <AppRoutes />
  );
}

export default App;
