import axios from '../../lib/axios'; // Ensure this path is correct

const BASE_URL = '/products'; 

export interface Product {
    id: number;
    name: string;
    description?: string;
    price: number;
    date_add?: string; 
    created_at: string;
}

// Get all products
export const getProducts = async (token: string): Promise<Product[]> => {
    try {
        const response = await axios.get<Product[]>(BASE_URL, {
            headers: {
                Authorization: `Bearer ${token}` // Add token here
            }
        });
        return response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
        throw error; // Optionally throw error to handle it in the component
    }
};

// Create a new product
export const createProduct = async (productData: Omit<Product, 'id'>, token: string): Promise<Product> => {
    try {
        const response = await axios.post<Product>(BASE_URL, productData, {
            headers: {
                Authorization: `Bearer ${token}` // Add token here
            }
        });
        return response.data;
    } catch (error) {
        console.error('Error creating product:', error);
        throw error;
    }
};

// Get a product by ID
export const getProductById = async (id: number, token: string): Promise<Product> => {
    try {
        const response = await axios.get<Product>(`${BASE_URL}/${id}`, {
            headers: {
                Authorization: `Bearer ${token}` // Add token here
            }
        });
        return response.data;
    } catch (error) {
        console.error(`Error fetching product with ID ${id}:`, error);
        throw error;
    }
};

// Update a product
export const updateProduct = async (id: number, productData: Partial<Product>, token: string): Promise<Product> => {
    try {
        const response = await axios.put<Product>(`${BASE_URL}/${id}`, productData, {
            headers: {
                Authorization: `Bearer ${token}` // Add token here
            }
        });
        return response.data;
    } catch (error) {
        console.error(`Error updating product with ID ${id}:`, error);
        throw error;
    }
};

// Delete a product
export const deleteProduct = async (id: number, token: string): Promise<void> => {
    try {
        await axios.delete(`${BASE_URL}/${id}`, {
            headers: {
                Authorization: `Bearer ${token}` // Add token here
            }
        });
    } catch (error) {
        console.error(`Error deleting product with ID ${id}:`, error);
        throw error;
    }
};
