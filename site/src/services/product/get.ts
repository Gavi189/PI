import { IProduct } from "@/interfaces/IProduct";

export const fetchProducts = async (): Promise<IProduct[]> => {
  const response = await fetch("http://localhost:8080/produtos", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  });
  const result = await response.json();
  return Array.isArray(result.data) ? result.data : [];
};
