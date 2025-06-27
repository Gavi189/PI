import { Produto } from "@/interface/produto";

// Simulação de chamada a uma API ou banco de dados
export let produtos: { data: Produto[] } = { data: [] };

try {
  const request = await fetch("http://localhost:8080/produtos", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  });
  produtos = await request.json();
} catch (error) {
  console.error("Erro ao buscar produtos:", error);
  // produtos permanece como array vazio
}

export {};
