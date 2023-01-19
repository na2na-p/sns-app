import { createContext } from 'react';

import type User from '@/types/models/User';

const UserContext = createContext<User | null>(null);

export default UserContext;
